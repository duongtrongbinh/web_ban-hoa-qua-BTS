import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../services/product.service';
import { AddressService } from '../../services/address.service';
import { BillService } from '../../services/bill.service';
import { ConfigService } from '../../services/config.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html'
})

export class CartComponent implements OnInit{
  url:string = this.urlConfig.urlFont;
  products:any[] = [];

 

  constructor(private product:ProductService,private address: AddressService,private thanhtoan: BillService,private urlConfig: ConfigService){

  } 

  
  ngOnInit(): void {
    // this.provinceControl = new FormControl();
    this.products = this.product.getItems();

      console.log(this.products);

  

          
  }
  sumOneProduct(quantity:number,price:number){
    var sum = quantity * price;
    return sum;
  }
  updateQuantity(id:number,event:any){
    const quantity = event.target.value;
    const index = this.products.findIndex((item:any )=> item.id === id);
    this.products[index].quantity = quantity;
    // Lưu mảng đã sửa vào localStorage
    localStorage.setItem('product', JSON.stringify(this.products));

  }
  

}
