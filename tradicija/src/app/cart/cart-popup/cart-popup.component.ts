
import {Component, HostBinding, ElementRef} from "@angular/core";
import {CartBaseComponent} from "../cart-base.component";
import { CartService } from "../cart.service";

@Component({
    selector: 'cart-popup',
    styleUrls: ["cart-popup.component.css"],
    templateUrl: 'cart-popup.component.html',
    host: {
        '(document:click)': 'onPageClick($event)',
    }
})
export class CartPopupComponent extends CartBaseComponent{
    @HostBinding("class.visible") isVisible:boolean = false;

    constructor(
        protected cartService: CartService,
        private eleref: ElementRef
    ) {
        super(cartService);
    }
    ngOnInit() {
        this.cartService.toggleCartSubject.subscribe(res => {
          console.log("vidljiv"+res);
            this.isVisible = res;
        });
    }
    onPageClick = (event) => {
        if (this.isVisible && !this.eleref.nativeElement.contains(event.target) && event.target.className !== 'cart-remove'){
            this.cartService.toggleCart();
        }
    };
}
