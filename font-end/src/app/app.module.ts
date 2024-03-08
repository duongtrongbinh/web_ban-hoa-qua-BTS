import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { CommonModule, DatePipe } from '@angular/common';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './Layouts/header/header.component';
import { SidebarComponent } from './Layouts/sidebar/sidebar.component';
import { CartComponent } from './Pages/cart/cart.component';
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
import { InformationComponent } from './Pages/account/information/information.component';
import { OrdersComponent } from './Pages/account/orders/orders.component';
import { OrderDetailComponent } from './Pages/account/order-detail/order-detail.component';
import { ListbuttonComponent } from './Pages/account/listbutton/listbutton.component';


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
    TrangchuComponent,
    InformationComponent,
    OrdersComponent,
    OrderDetailComponent,
    ListbuttonComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    CommonModule,
    ReactiveFormsModule
  ],
  providers: [DatePipe],
  bootstrap: [AppComponent,TrangchuComponent]
})
export class AppModule { }
