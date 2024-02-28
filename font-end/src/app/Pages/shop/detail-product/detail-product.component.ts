import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from '../../../services/product.service';
import { Icart } from '../../../interface/icart';

@Component({
  selector: 'app-detail-product',
  templateUrl: './detail-product.component.html',
  styleUrl: './detail-product.component.css'
})
export class DetailProductComponent implements OnInit{
  product:any;
  url:string = 'http://127.0.0.1:8000';
  items: Icart[] = [];

  constructor(private route: ActivatedRoute, private pro: ProductService){}
  ngOnInit(): void {
    this.route.params.subscribe(params => {
      const id = params['id'];
      this.pro.getOneProduct(id).subscribe(data=>{
        this.product = data;
        console.log(data);

      })  

    }); 
  }

  addToCart(product: Icart){

      this.pro.cartProduct(product);
      // console.log(this.pro.getItems());

  }
}
