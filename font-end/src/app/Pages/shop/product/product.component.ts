import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../../services/product.service';
import { ConfigService } from '../../../services/config.service';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrl: './product.component.css'
})
export class ProductComponent implements OnInit{
  products:any;
  url:string = this.urlConfig.url;
  constructor(private pro: ProductService,private urlConfig: ConfigService){}
  ngOnInit(): void {
      this.pro.getProduct().subscribe(data=>{
        console.log(data);
        this.products = data;

      });
  }
}
