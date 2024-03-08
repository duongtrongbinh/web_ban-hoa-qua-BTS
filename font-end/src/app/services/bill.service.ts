import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { HeaderTokenService } from './header-token.service';
import { Observable } from 'rxjs';
import { ConfigService } from './config.service';

@Injectable({
  providedIn: 'root'
})
export class BillService {

  constructor(private http : HttpClient, private headerToken: HeaderTokenService,private urlConfig: ConfigService) { }
  urlPay:string= this.urlConfig.url +"/api/bill";
  urlOrders:string= this.urlConfig.url +"/api/orders";

  pay(data:any){
    let headers = this.headerToken.headerToken();
    return this.http.post<any>(this.urlPay,data,{headers});
  }
  orders(data:any): Observable<any>{
    let headers = this.headerToken.headerToken();
    return this.http.post<any>(this.urlOrders,data,{headers});
  }

}
