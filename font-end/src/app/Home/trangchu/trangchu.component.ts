import { Component, OnInit } from '@angular/core';
import { HomeService } from '../../services/home.service';


@Component({
  selector: 'app-trangchu',
  templateUrl: './trangchu.component.html',
  styleUrl: './trangchu.component.css'
})
export class TrangchuComponent implements OnInit {
  category:any;
  images: any[] = [];
  constructor(private home: HomeService){}
  ngOnInit(): void {
      // this.home.getListBlog().subscribe(re => {
      //   this.category = re;
    
      this.home.getSlides().subscribe(
        (data) => {
          this.images = data;
        },
        (error) => {
          console.error('Error fetching images:', error);
        }
      );

  }
}
