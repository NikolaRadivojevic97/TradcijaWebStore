import {  Covers, Model, Combination } from "../products/products.model";


export class Cart {
    id:number;
    products: CartCover[];
    total:number;
}
export class CartCover{
  id:number;
  car:CartCar;
  combination:Combination;
  url:string;
  price:number;
}
export class CartCar{
  model:Model;
  bodyType:string;
  generation:string;
  equipmentLevel:string;
  url:string;
}
