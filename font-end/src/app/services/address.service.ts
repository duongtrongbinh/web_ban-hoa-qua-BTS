import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AddressService {

  constructor(private http: HttpClient, private router: Router) { }
  urlProvince:string="https://online-gateway.ghn.vn/shiip/public-api/master-data/province";
  urlDistrict:string="https://online-gateway.ghn.vn/shiip/public-api/master-data/district";
  urlWard:string="https://online-gateway.ghn.vn/shiip/public-api/master-data/ward";
  urlShip:string="https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee";
  
  header = {
    'Content-Type':'application/json',
    'token':'d4d4cd6f-8f70-11ee-96dc-de6f804954c9'
  };
  headersder ={
    'Content-Type':'application/json',
    'token':'d4d4cd6f-8f70-11ee-96dc-de6f804954c9',
    'ShopId':'4734816'
  };
  getProvince(){
    return this.http.get(this.urlProvince,{headers: this.header});
  }
  getDistrict(province:number){

    return this.http.post(this.urlDistrict,{"province_id":province},{headers: this.header});
  } 
  getWard(district:number){
    return this.http.post(this.urlWard,{"district_id":district},{headers: this.header});
    
  } 
  ship(data:any){
    return this.http.post(this.urlShip,data,{headers: this.headersder});
  }
}
