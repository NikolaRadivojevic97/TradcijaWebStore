import { CartService } from './cart/cart.service';
import { FooterComponent } from './footer/footer.component';
import { AppRoutingModule } from './app-routing.module';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import { ProductsService } from './products/products.service';
import { AuthService } from './auth/auth.service';
import { HttpModule } from '@angular/http';
import { HttpClientModule } from '@angular/common/http';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { AdminService } from './admin/admin.service';
import { UserService } from './profile/user.service';
import { AuthGuard } from './auth/auth-guard';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';


@NgModule({
  declarations: [AppComponent, FooterComponent],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpModule,
    HttpClientModule,
    FontAwesomeModule,
    BrowserAnimationsModule,
  ],
  providers: [ProductsService,CartService, AuthService, AdminService, UserService, AuthGuard],
  bootstrap: [AppComponent]
})
export class AppModule { }
