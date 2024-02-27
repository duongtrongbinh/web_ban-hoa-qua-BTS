import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AboutComponent } from './Pages/about/about.component';
import { ListComponent } from './Pages/blog/list/list.component';
import { DetailBlogComponent } from './Pages/blog/detail-blog/detail-blog.component';
import { CartComponent } from './Pages/cart/cart.component';
import { ContactComponent } from './Pages/contact/contact.component';
import { ProductComponent } from './Pages/shop/product/product.component';
import { DetailProductComponent } from './Pages/shop/detail-product/detail-product.component';
import { LoginOderComponent } from './Pages/order/login-oder/login-oder.component';
import { RegisterOderComponent } from './Pages/order/register-oder/register-oder.component';
import { ProfileComponent } from './Pages/account/profile/profile.component';
import { LoginComponent } from './Pages/account/login/login.component';
import { RegisterComponent } from './Pages/account/register/register.component';
import { TrangchuComponent } from './Home/trangchu/trangchu.component';

const routes: Routes = [
  { path: '' , component: TrangchuComponent, title: 'Trang chu'},
  { path: 'about' , component: AboutComponent, title: 'About'},
  { path: 'blog' , component: ListComponent, title: 'list blog'},
  { path: 'blog/detail' , component: DetailBlogComponent, title: 'detail blog'},
  { path: 'cart' , component: CartComponent, title: 'detail blog'},
  { path: 'contact' , component: ContactComponent, title: 'contact'},
  { path: 'shop' , component: ProductComponent, title: 'Product'},
  { path: 'shop/detail/:id' , component: DetailProductComponent, title: 'detail product'},
  { path: 'order/login' , component: LoginOderComponent, title: 'order-login'},
  { path: 'order/register' , component: RegisterOderComponent, title: 'order-register'},
  { path: 'account/profile' , component: ProfileComponent, title: 'profile'},
  { path: 'account/login' , component: LoginComponent, title: 'login'},
  { path: 'account/register' , component: RegisterComponent, title: 'register'},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
