import { FormControl, ReactiveFormsModule, FormsModule } from '@angular/forms';
import { ProductsListComponent } from './products-list/products-list.component';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { ProductsRoutingModule } from './products-routing.module';
import { ProductsComponent } from './products.component';
import { ProductDetailComponent } from './product-detail/product-detail.component';
import { CommonModule } from '@angular/common';
import { NavbarModule } from '../navbar/navbar.module';
import { NewCarComponent } from './new-product/new.component';
import {MatAutocompleteModule} from '@angular/material/autocomplete';
import {MatFormFieldModule} from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';


@NgModule({
  declarations: [
    ProductDetailComponent,
    ProductsComponent,
    ProductsListComponent,
    NewCarComponent
  ],
  imports: [
    CommonModule,
    RouterModule,
    ProductsRoutingModule,
    NavbarModule,
    ReactiveFormsModule,
    FormsModule,
    MatAutocompleteModule,
    MatFormFieldModule,
    MatInputModule
    ]
})
export class ProductsModule {}
