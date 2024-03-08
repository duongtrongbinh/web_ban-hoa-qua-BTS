import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HeaderTokenService } from './header-token.service';
import { Icart } from '../interface/icart';
import { ConfigService } from './config.service';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  private apiUrl =this.urlConfig.url + '/api/products';
  private apiUrlShow =this.urlConfig.url + '/api/product/';
  private apiUrlCart = this.urlConfig.url + '/api/product/addToCart/';

  constructor(private http: HttpClient,  private urlConfig: ConfigService) { }
  items: Icart[] = [];

  getProduct(): Observable<any> {
    return this.http.get(this.apiUrl);
  }
  getOneProduct(id:string): Observable<any>{
    return this.http.get(this.apiUrlShow + id);
  }

  cartProduct(product:any){
    var c:Icart;
    c = { 
      id: product.id, 
      name: product.name, 
      price: product.price, 
      code_image: product.images[0].code_image, 
      quantity: 1,
      name_image:product.images[0].name,
      weight:parseInt(product.weight,10),
      width:product.width,
      height:parseInt(product.height,10),
      length:parseInt(product.length,10)
    };
    var x = this.getItems();
      if(x){
      const index = x.findIndex((item:any )=> item.id === product.id);
      if(index>=0){
        x[index].quantity += 1;
        // Lưu mảng đã sửa vào localStorage
        localStorage.setItem('product', JSON.stringify(x));
      }else{
        x.push(c); 
        localStorage.setItem('product', JSON.stringify(x));
      }
    }else{
      this.items.push(c); 
      localStorage.setItem('product', JSON.stringify(this.items));
    }
    

  }
  getItems(){ 
    const storedItem = localStorage.getItem('product');
    return storedItem ? JSON.parse(storedItem) : null;
  }
  getUser(){
    const storedItem = localStorage.getItem('user');
    const user = storedItem ? JSON.parse(storedItem) : null;
    return user.id;
  }
}
