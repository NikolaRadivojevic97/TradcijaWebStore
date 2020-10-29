import { switchMap } from 'rxjs/operators';
import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { catchError, tap } from 'rxjs/operators';
import { throwError, Subject, BehaviorSubject } from 'rxjs';
import { User } from './user.model';
import { Router } from '@angular/router';
import jwt_decode from "jwt-decode";
//format odgovora
export interface AuthResponseData {
    token:string;
}

@Injectable({ providedIn: 'root' })
export class AuthService {
    //razlika u odnosu na Subject, moze da subrscribuje na vec postojece vrednosti
    user = new BehaviorSubject<User>(null);
    private tokenExspirationTimer: any;

    constructor(private http: HttpClient, private router: Router) { }

    register(firstName: string, lastName: string, email:string, address:string, city:string, zipCode:string,phoneNumber:string, username:string,password:string,retypedPassword:string) {
        return this.http.post('http://localhost:8000/api/users',
            { username:username, password:password, retypedPassword:retypedPassword, info:{ firstName:firstName, lastName:lastName, email:email, address:address, city:city, zipCode:zipCode, phoneNumber:phoneNumber} }).
            pipe(catchError(this.handleRegError));
    }
    login(username: string, password: string) {
        return this.http.post<AuthResponseData>('http://localhost:8000/api/login_check',
            { username: username, password: password})
            .pipe(catchError(this.handleError), switchMap(resData => {
              let token=resData.token;
              let tokenInfo=jwt_decode(token);
              console.log(tokenInfo);
              let exp=tokenInfo.exp;
              let username=tokenInfo.username;
              let role=tokenInfo.roles[0];
              const expirationDate = new Date(exp*1000);
              const headers = new HttpHeaders({
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
              })
              if(localStorage.getItem('shoppingCart')){
              this.http.put("http://localhost:8000/api/shopping_carts/"+localStorage.getItem('shoppingCart').valueOf()+'/add-customer',{},{headers:headers}).subscribe();
              }
               return this.http.get("http://localhost:8000/api/users?username="+username,{ headers:headers, observe:'response'},).pipe(tap((res)=>{
                let b=res['body'];
                let a=b['hydra:member'];
                console.log(a);
                let user=new User(username, a[0].id, token, expirationDate, role);
                 this.user.next(user);
                 this.autoLogout(exp*1000-new Date().getTime());
                // //postavlja usera u localStorage, u string formatu treba
                 localStorage.setItem('userData', JSON.stringify(user));
              }));
            }));
    }
    private handleAuth(token: string) {

    }
    private handleError(errorRes: HttpErrorResponse) {
        let errorMessage = 'Incorrect username or password';
        return throwError(errorMessage);
    }
    private handleRegError(errorRes: HttpErrorResponse) {
      let errorMessage = 'Already exist user with samo username';
      return throwError(errorMessage);
  }
    logout() {
        this.user.next(null);
        //this.router.navigate(['/auth']);
        localStorage.removeItem('userData');
        localStorage.removeItem('shoppingCart');
        if (this.tokenExspirationTimer) {
            clearTimeout(this.tokenExspirationTimer);
        }
        this.tokenExspirationTimer = null;
    }
    //pozivana nam svaki put kad se otvori stranica ili reloaduje
    autoLogin() {
        //pokupi iz localStoragea
        const userData: { username: string, id: string, _token: string, _tokenExpirationDate: string, role:string } = JSON.parse(localStorage.getItem('userData'));
        if (!userData) {
            //ako nema usera u localStorage samo return nista ne radi
            return;
        }
        const loadedUser = new User(userData.username, userData.id, userData._token, new Date(userData._tokenExpirationDate), userData.role);
        if (userData._token) {
            this.user.next(loadedUser);
            const expirationDurantion=new Date(userData._tokenExpirationDate).getTime()-new Date().getTime();
            this.autoLogout(expirationDurantion);
        }
    }
    autoLogout(expirationDuration: number) {
        console.log(expirationDuration);
        this.tokenExspirationTimer = setTimeout(() => {
            this.logout();
        }, expirationDuration)
    }
}
