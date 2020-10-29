import { AuthService } from './../auth/auth.service';
import { Component, OnInit, Input } from '@angular/core';
import { Router, NavigationEnd } from '@angular/router';
import { CartService } from '../cart/cart.service';
// import { CartService } from '../cart/cart.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent{
  @Input()isHome:boolean;
  public isCollapsed = false;
  public user=null;
  public admin=false;
  public cart_num:number;
    constructor(
        private cartService: CartService, private authService:AuthService
    ) { }

    ngOnInit() {
    this.authService.autoLogin();
      if(localStorage.getItem('shoppingCart')){
      this.cartService.fetchCart().subscribe();
      this.cartService.cart.subscribe((res)=>{
        this.cart_num=res.length;
      })
    }
    if(localStorage.getItem('userData')){
      let user=JSON.parse(localStorage.getItem('userData'))["username"];
      let role=JSON.parse(localStorage.getItem('userData'))["role"];
      //console.log(localStorage.getItem('userData').valueOf());
      this.user=user;
      if(role==="ROLE_ADMIN"){
        this.admin=true;
      }
    }
    }
    toggleCartPopup = (event) => {
      console.log("usao u toggle");
        event.preventDefault();
        event.stopPropagation();
        this.cartService.toggleCart();
    }
    onShop(){
      this.cartService.setCart();
    }
}
