import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HeaderTokenService } from './header-token.service';
import { Icart } from '../interface/icart';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  private apiUrl = 'http://127.0.0.1:8000/api/products';
  private apiUrlShow = 'http://127.0.0.1:8000/api/product/';
  private apiUrlCart = 'http://127.0.0.1:8000/api/product/addToCart/';

  constructor(private http: HttpClient,  private headerToken: HeaderTokenService) { }
  items: Icart[] = [];

  getProduct(): Observable<any> {
    let headers = this.headerToken.headerToken();
    return this.http.get(this.apiUrl, {headers:headers});
  }
  getOneProduct(id:string): Observable<any>{
    let headers = this.headerToken.headerToken();
    return this.http.get(this.apiUrlShow + id,{headers:headers});
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
}
