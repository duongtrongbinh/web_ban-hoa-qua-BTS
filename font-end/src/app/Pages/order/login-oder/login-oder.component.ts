import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../../services/product.service';
import { AddressService } from '../../../services/address.service';
import { BillService } from '../../../services/bill.service';
import { NgForm } from '@angular/forms';
import { Order } from '../../../interface/order';

@Component({
  selector: 'app-login-oder',
  templateUrl: './login-oder.component.html',
  styleUrl: './login-oder.component.css'
})
export class LoginOderComponent implements OnInit{
  url:string = 'http:127.1.1.0.8';
  products:any[] = [];
  Province:any = 0;
  District:any = 0;
  Ward:any = 0;
  apiResponseArray: any[] = [];
  ProvinceID:number =0;
  DistrictID:number =0;
  WardID:number =0;
  Provincename:string ='';
  Districtname:string ='';
  Wardname:string ='';
  data:any;
  moneyship:any;
  subtodtal:number = 0;
  nameErr:string ='';
  TTErr:string ='';
  addressErr:string ='';
  phoneErr:string ='';
  wardErr:string ='';
  provinceErr:string ='';
  districtErr:string ='';
  user_id:number =0;
  constructor(private product:ProductService,private address: AddressService,private thanhtoan: BillService){}
  ngOnInit(): void {
    this.products = this.product.getItems();

    this.user_id = this.product.getUser();
    
    let subtotal = this.products.reduce((accumulator, currentItem) => {
      accumulator.quantityPrice += currentItem.quantity * currentItem.price;
      return accumulator;
    }, {quantityPrice: 0});

    this.subtodtal = subtotal.quantityPrice;
    // console.log(this.subtodtal);
    this.address.getProvince().subscribe(re=>{
      this.Province = re;
      console.log(this.Province);
    },
    err=>{
      this.Province = "đường truyền bị lỗi.";
    })
  }

  sumOneProduct(quantity:number,price:number){
    var sum = quantity * price;
    return sum;
  }

  dis(ProvinceID:number){
    interface ProvinceType {
      ProvinceID: number;
      ProvinceName: string;
    }
    let foundProvince: ProvinceType = (this.Province.data).find((item: ProvinceType) => item.ProvinceID === ProvinceID);
    this.Provincename = foundProvince.ProvinceName;
    this.address.getDistrict(ProvinceID).subscribe(re=>{
      this.District = re;
      console.log(this.District);

    }
    ,err=>{
      this.District = "đường truyền bị lỗi.";

    })
  }

  ward(DistrictID:number){
    interface ProvinceType {
      DistrictID: number;
      DistrictName: string;
    }
    let foundDistrict: ProvinceType = (this.District.data).find((item: ProvinceType) => item.DistrictID === DistrictID);
    this.Districtname = foundDistrict.DistrictName;
    this.address.getWard(DistrictID).subscribe(re=>{
      this.Ward = re;
      console.log(this.Ward);
    }
    ,err=>{
      this.Ward = "đường truyền bị lỗi.";

    })
  }
  //địa chỉ nhận hàng 
  getprovince(selectedValue: any):any{
    const PProvinceID = selectedValue.target.value;
    this.ProvinceID =parseInt(PProvinceID,10);
    this.dis(parseInt(PProvinceID,10));

  }
  getdistrict(selectedValue: any){
    const districtt = selectedValue.target.value;
    this.DistrictID =parseInt(districtt,10);
    this.ward(parseInt(districtt,10))
  }

  Moneyship(selectedValue: any){
    const wardsd = selectedValue.target.value;
    this.WardID =wardsd;

    interface ProvinceType {
      WardCode: number;
      WardName: string;
    }
    let foundWard: ProvinceType = (this.Ward.data).find((item: ProvinceType) => item.WardCode === this.WardID);
    this.Wardname = foundWard.WardName;

    let total = this.products.reduce((accumulator, currentItem) => {
      accumulator.weight += currentItem.weight * currentItem.quantity;
      accumulator.length += currentItem.length * currentItem.quantity;
      accumulator.quantityPrice += currentItem.quantity * currentItem.price;
      accumulator.height += currentItem.height * currentItem.quantity;
      accumulator.width += currentItem.width * currentItem.quantity;
      return accumulator;
    }, { weight: 0, length: 0, quantityPrice: 0, height: 0, width: 0 });
    console.log(total);
    const dataser:Order = {
      "service_type_id":2,
      "from_district_id":0,
      "to_district_id":this.DistrictID,
      "to_ward_code":wardsd,
      "height":total.height,
      "length":total.length,
      "weight":total.weight,
      "width":total.width,
      "insurance_value":total.quantityPrice,
      "coupon": null
    };
    this.data = dataser;
 
    console.log(this.data);
    this.address.ship(this.data).subscribe(re=>{
      console.log(re);
      this.moneyship = re;
    },
    err=>{
      console.log(err);
    })


  }


  onSubmit(form:NgForm){
    
    const data ={
        data1: form.value,
        data: this.data,
        data3:this.products
          } ;
          data.data1.provinceName = this.Provincename;
          data.data1.districtName = this.Districtname;
          data.data1.wardName = this.Wardname;
          data.data1.moneyship=this.moneyship.data.total;
          data.data1.user_id=this.user_id;
          data.data1.addressA= form.value.address + ', '+ this.Wardname + ' , '+ this.Districtname + ' , '+ this.Provincename,
    console.log(data);
    this.thanhtoan.pay(data).subscribe(re=>{
      console.log(re);
      localStorage.removeItem('product');
      window.location.href = re;

    },
    err=>{
      console.log(err);

      this.nameErr=err.error.errors.name;
      this.TTErr=err.error.errors.TT;
      this.addressErr=err.error.errors.address;
      this.phoneErr=err.error.errors.phone;
      this.wardErr=err.error.errors.ward;
      this.provinceErr=err.error.errors.province;
      this.districtErr=err.error.errors.district;
    });
  }
 
}
