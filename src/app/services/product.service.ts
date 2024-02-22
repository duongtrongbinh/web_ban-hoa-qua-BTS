import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HeaderTokenService } from './header-token.service';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  private apiUrl = 'http://127.0.0.1:8000/api/products';
  private apiUrlShow = 'http://127.0.0.1:8000/api/product/';
  private apiUrlCart = 'http://127.0.0.1:8000/api/product/addToCart/';

  constructor(private http: HttpClient,  private headerToken: HeaderTokenService) { }
  getProduct(): Observable<any> {
    let headers = this.headerToken.headerToken();
    return this.http.get(this.apiUrl, {headers:headers});
  }
  getOneProduct(id:string): Observable<any>{
    let headers = this.headerToken.headerToken();
    return this.http.get(this.apiUrlShow + id,{headers:headers});
  }

  cartProduct(id:number,quantity:number): Observable<any>{
    let headers = this.headerToken.headerToken();
    return this.http.get(this.apiUrlCart + id + '/'+ quantity,{headers:headers});
  }
}
