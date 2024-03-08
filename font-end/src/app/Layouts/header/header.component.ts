import { Component, OnInit } from '@angular/core';
import { CartService } from '../../services/cart.service';
import { ProductService } from '../../services/product.service';
import { Router } from '@angular/router';
import { AuthencationService } from '../../services/authencation.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrl: './header.component.css',
  template: `
  <!-- Your header content here -->
  <app-detail-product (addToCartEvent)="handleDataFromChild($event)" />

`,
})
export class HeaderComponent implements OnInit {
  quantity:number = 0;

  constructor(private cartService: CartService,private auth: AuthencationService, private router: Router,private product:ProductService){}
  ngOnInit(): void {

  }
  handleDataFromChild(data: number) {
    console.log(data); // In ra: "Data from child"
    this.quantity = data;
  }

}
