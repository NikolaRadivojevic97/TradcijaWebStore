import { Cart, CartCover } from "./cart";
import { CartService } from "./cart.service";
import { Covers } from "../products/products.model";
export class CartBaseComponent{
    public covers:CartCover[];
    public total:number;
    constructor(protected cartService: CartService) {
        this.loadCart();
    }
    loadCart = () => {
        this.cartService.cart
            .subscribe(res => {
                this.covers = res;
                let total = 0;
                for(let cover of this.covers) {
                    total += cover.price;
                }
                this.total = total;
            })
    };
    removeFromCart(cover:CartCover){
        this.cartService.removeCart(cover);
    };
}
