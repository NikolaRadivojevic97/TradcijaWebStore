
// export class Recipe{
//     public name:string;
//     public description:string;
//     public imagePath:string;
//     public ingredients:Ingredient[];
//     constructor(name:string, description:string, imagePath:string, ingredients: Ingredient[]){
//         this.name=name;
//         this.description=description;
//         this.imagePath=imagePath;
//         this.ingredients=ingredients;
//     }
// }
export class Brand{
  name:string;
  constructor(name:string){
    this.name=name;
  }
}
export class Model{
  name:string;
  brand:Brand;
  constructor(name:string, brand:Brand){
    this.name=name;
    this.brand=brand;
  }
}
export class Combination{
  color1:string;
  color2:string;
  url:string;
  description:string;
  constructor(color1:string, color2:string, url:string, descrription:string){
    this.color1=color1;
    this.color2=color2;
    this.url=url;
    this.description=descrription;
  }
}
export class Covers{
  id:number;
  combination:Combination;
  url:string;
  price:number;
  constructor(id:number, combination:Combination, url:string, price:number){
    this.id=id;
    this.combination=combination;
    this.url=url;
    this.price=price;
}
}


export class Car {
  id:number
  model:Model;
  bodyType:string;
  generation:string;
  equipmentLevel:string;
  url:string;
  covers:Covers[];
  constructor(id:number, model:Model, bodyType:string,generation:string, equipmentLevel:string, url:string, covers:Covers[]){
    this.id=id;
    this.model=model;
    this.bodyType=bodyType;
    this.generation=generation;
    this.equipmentLevel=equipmentLevel;
    this.url=url;
    this.covers=covers;
  }
}
export class ModelSearch{
  id:number;
  name:string;
}
export class BrandSearch{
  id:number;
  name:string;
  models:ModelSearch[];
}
export class CombinationSearch{
  id:number;
  color1:string;
  color2:string;
  url:string;
  description:string;
  constructor(id:number,color1:string, color2:string, url:string, descrription:string){
    this.id=id;
    this.color1=color1;
    this.color2=color2;
    this.url=url;
    this.description=descrription;
  }
}
