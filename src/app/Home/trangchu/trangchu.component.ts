import { Component, OnInit } from '@angular/core';
import { HomeService } from '../../services/home.service';
// import * as bootstrap from 'bootstrap';
import * as bootstrap from 'bootstrap';
import * as $ from 'jquery';


@Component({
  selector: 'app-trangchu',
  templateUrl: './trangchu.component.html',
  styleUrl: './trangchu.component.css'
})
export class TrangchuComponent implements OnInit {
  category:any;
  constructor(private home: HomeService){}
  ngOnInit(): void {
      // this.home.getListBlog().subscribe(re => {
      //   this.category = re;
      // })
      var myCarousel = document.querySelector('#myCarousel');
      if (myCarousel) {
        var carousel = new bootstrap.Carousel(myCarousel);
      }
  }
}
