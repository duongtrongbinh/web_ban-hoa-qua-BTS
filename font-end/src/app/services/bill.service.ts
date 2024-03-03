import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { HeaderTokenService } from './header-token.service';

@Injectable({
  providedIn: 'root'
})
export class BillService {

  constructor(private http : HttpClient, private headerToken: HeaderTokenService) { }
  urlPay:string="http://127.0.0.1:8000/api/bill";

  pay(data:any){
    let headers = this.headerToken.headerToken();
    return this.http.post<any>(this.urlPay,data,{headers});
  }

}
