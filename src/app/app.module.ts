import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';


import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './Layouts/header/header.component';
import { SidebarComponent } from './Layouts/sidebar/sidebar.component';
import { CartComponent } from './Layouts/cart/cart.component';
import { FooteComponent } from './Layouts/foote/foote.component';
import { ProductComponent } from './Pages/shop/product/product.component';
import { DetailProductComponent } from './Pages/shop/detail-product/detail-product.component';
import { AboutComponent } from './Pages/about/about.component';
import { ContactComponent } from './Pages/contact/contact.component';
import { ListComponent } from './Pages/blog/list/list.component';
import { DetailBlogComponent } from './Pages/blog/detail-blog/detail-blog.component';
import { LoginComponent } from './Pages/account/login/login.component';
import { ProfileComponent } from './Pages/account/profile/profile.component';
import { RegisterComponent } from './Pages/account/register/register.component';
import { LoginOderComponent } from './Pages/order/login-oder/login-oder.component';
import { RegisterOderComponent } from './Pages/order/register-oder/register-oder.component';
import { TrangchuComponent } from './Home/trangchu/trangchu.component';
import { HttpClientModule } from '@angular/common/http';
import { CommonModule } from '@angular/common';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    SidebarComponent,
    CartComponent,
    FooteComponent,
    ProductComponent,
    DetailProductComponent,
    AboutComponent,
    ContactComponent,
    ListComponent,
    DetailBlogComponent,
    LoginComponent,
    ProfileComponent,
    RegisterComponent,
    LoginOderComponent,
    RegisterOderComponent,
    TrangchuComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    CommonModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
