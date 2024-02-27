import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../../services/product.service';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrl: './product.component.css'
})
export class ProductComponent implements OnInit{
  products:any;
  url:string = 'http://127.0.0.1:8000';
  constructor(private pro: ProductService){}
  ngOnInit(): void {
      this.pro.getProduct().subscribe(data=>{
        console.log(data);
        this.products = data;

      });
  }
}
