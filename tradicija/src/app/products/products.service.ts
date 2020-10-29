import { Injectable } from '@angular/core';
import {Http,Response} from "@angular/http";
import { map, tap } from 'rxjs/operators';
//moramo ovo da dodamo da bi ubacili shoppingListService u ovaj servis
@Injectable()
export class ProductsService{
  constructor(public http: Http) { }

    public getProducts(){
      console.log("ovde je");
        return this.http.get('http://localhost:8000/api/cars').pipe(
          map((data:Response) =>{
            //console.log("usao je");
            return data.json()['hydra:member'];
          })
        );
        // return this.http.get(dataURL).pipe(
        //     map((res:Response) => res.json())
        //     );
    }
    public getProduct(id:number){
        return this.http.get('http://localhost:8000/api/cars/'+id).pipe(
          map((data:Response) =>{
            //console.log(data.json());
            return data.json();
          })
        );
        // return this.http.get(dataURL).pipe(
        //     map((res:Response) => res.json())
        //     );
    }
    public getBrands(){
      return this.http.get('http://localhost:8000/api/brands').pipe(
          map((data:Response) =>{
            //console.log("usao je");
            return data.json()['hydra:member'];
          })
        );
    }
  // recipeChanged=new Subject<Recipe[]>();
  //   private recipes: Recipe[] = [];
  //   constructor(private slService: ShoppingListService){}
  //     getRecipes(){
  //         //da nam vraca kopiju a ne pravi niz
  //         return this.recipes.slice();
  //     }
  //     addIngredientToShoppingList(ingredients: Ingredient[]){
  //       this.slService.addIngredients(ingredients);
  //     }
  //     getRecipe(index:number){
  //       return this.recipes[index];
  //     }
  //     addRecipe(recipe:Recipe){
  //       this.recipes.push(recipe);
  //       this.recipeChanged.next(this.recipes.slice());
  //     }
  //     updateRecipe(index:number, newRecipe:Recipe){
  //       this.recipes[index]=newRecipe;
  //       this.recipeChanged.next(this.recipes.slice());
  //     }
  //     deleteRecipe(index:number){
  //       this.recipes.splice(index,1);
  //       this.recipeChanged.next(this.recipes.slice());
  //     }
  //     setRecipes(recipes:Recipe[]){
  //       this.recipes=recipes;
  //       this.recipeChanged.next(this.recipes.slice());
  //     }
}
