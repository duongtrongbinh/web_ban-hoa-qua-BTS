import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from '../../../services/product.service';

@Component({
  selector: 'app-detail-product',
  templateUrl: './detail-product.component.html',
  styleUrl: './detail-product.component.css'
})
export class DetailProductComponent implements OnInit{
  product:any;
  url:string = 'http://127.0.0.1:8000';
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

  addToCart(id:number ,quantity:number){
      this.pro.cartProduct(id,quantity).subscribe(data=>{
        console.log(data);
        const c = confirm('sản phẩm đã có trong giỏ hàng.');
        if(c){
          console.log('ok2');
        }
      },
      err=>{
        console.log(err);
      });
  }
}
