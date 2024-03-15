import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from '../../../services/product.service';
import { Icart } from '../../../interface/icart';
import { ConfigService } from '../../../services/config.service';

@Component({
  selector: 'app-detail-product',
  templateUrl: './detail-product.component.html',
  styleUrl: './detail-product.component.css'
})
export class DetailProductComponent implements OnInit{
  product:any;
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
  x:number = 0;
  @Output() sendData = new EventEmitter<number>();
  addToCart(product: Icart){

      this.pro.cartProduct(product);
      // console.log(this.pro.getItems());
      this.x = this.product.getItems().length;
      this.sendData.emit(this.x);

  }
}
