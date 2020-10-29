import { Component, ComponentFactoryResolver, ViewChild, OnDestroy } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Observable, Subscription } from 'rxjs';
import { Router } from '@angular/router';
import { AuthService } from '../auth/auth.service';
// import { AlertComponent } from '../shared/alert.component';
// import { PlaceholderDirective } from '../shared/placeholder.directive';

@Component({
    selector: 'app-registration',
    templateUrl: './registration.component.html'
})
export class RegistrationComponent implements OnDestroy{
  isHome=false;
    error:string=null;
    private closeSub:Subscription;
    constructor(private authService: AuthService, private router:Router, private componenetFactoryResolver: ComponentFactoryResolver) { }
    onSubmit(form: NgForm) {
        // console.log(form);
        if (!form.valid || form.value.password!==form.value.retypedPassword) {
           this.error="sifre moraju biti iste";
           return;
        }
        const firstName=form.value.firstName;
        const lastName=form.value.lastName;
        const email= form.value.email;
        const address= form.value.address;
        const city=form.value.city;
        const zipCode=form.value.zipCode;
        const phoneNumber=form.value.phoneNumber;
        const username = form.value.username;
        const password = form.value.password;
        const retypedPassword=form.value.retypedPassword;
        this.authService.register(firstName, lastName, email, address, city, zipCode,phoneNumber, username,password,retypedPassword).subscribe(resData => {
            console.log(resData);
            this.router.navigate(['/home']);
        },
            errorMessage => {
            this.error=errorMessage;
            });
        form.reset();
    }
    onHandleError(){
        this.error=null;
    }
    ngOnDestroy(){
        if(this.closeSub){
            this.closeSub.unsubscribe();
        }
    }
}
