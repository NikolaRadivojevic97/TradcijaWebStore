import { Router } from '@angular/router';

import { Injectable } from '@angular/core';
import {BehaviorSubject} from "rxjs";
import { Cart, CartCover } from './cart';
import { Http } from '@angular/http';
import { take, tap, delay, switchMap, map } from "rxjs/operators";
import { Covers } from '../products/products.model';
import { CustomerInfo } from '../checkout/customerinfo';

@Injectable()
export class CartService {

    private _cart = new BehaviorSubject<CartCover[]>([]);
    public toggleCartSubject = new BehaviorSubject(false);
    constructor(private http:Http, private router:Router){}
    get cart(){
      return this._cart.asObservable();
    }
    toggleCart = () => {
      console.log(this.toggleCartSubject.getValue());
      this.toggleCartSubject.next(!this.toggleCartSubject.getValue());
    };
    addToCart (cover:Covers){
      return this.http
      .put(
        "http://localhost:8000/api/shopping_carts/"+localStorage.getItem('shoppingCart').valueOf()+'/add-product',
        {addProduct:'api/covers/'+cover.id}
      ).subscribe(()=>{
          this.fetchCart().subscribe();
      });
    }
    removeCart (cover:CartCover){
      console.log(cover.id);
      return this.http
      .put(
        "http://localhost:8000/api/shopping_carts/"+localStorage.getItem('shoppingCart').valueOf()+'/remove-product',
        {removeProduct:'api/covers/'+cover.id}).subscribe(
          ()=>{
          this.fetchCart().subscribe();
      });
    }
    setCart(){
      if(!localStorage.getItem('shoppingCart')){
      return this.http.post("http://localhost:8000/api/shopping_carts",{}).subscribe(
        (shoppingCart)=>{
          localStorage.setItem('shoppingCart', shoppingCart.json().id);
          console.log(localStorage.getItem('shoppingCart'));
        })
    }
  }
  fetchCart(){
    if(localStorage.getItem('shoppingCart')){
      return this.http.get("http://localhost:8000/api/shopping_carts/"+localStorage.getItem('shoppingCart').valueOf()).pipe(
        tap((shoppingCart)=>{
          this._cart.next(shoppingCart.json()["products"]);
        })
      );
    }
  }
  addCustomer(customerInfo:CustomerInfo){
    return this.http
      .put(
        "http://localhost:8000/api/shopping_carts/"+localStorage.getItem('shoppingCart').valueOf()+'/add-customer',
        {customer:{firstName:customerInfo.firstName, lastName:customerInfo.lastName, email:customerInfo.email, address:customerInfo.address, city:customerInfo.city, zipCode:customerInfo.zipCode, phoneNumber:customerInfo.phoneNumber}}).subscribe();
  }
  comfirmOrder(method:string){
    return this.http
      .post(
        "http://localhost:8000/api/orders",
        {shoppingCart:'api/shopping_carts/'+localStorage.getItem('shoppingCart').valueOf(), paymnet:'api/paymnets/'+method}).subscribe(()=>{
          localStorage.removeItem('shoppingCart');
          this.router.navigateByUrl('/home');
        });
  }

}
