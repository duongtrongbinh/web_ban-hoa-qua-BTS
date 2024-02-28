import { Component, OnInit } from '@angular/core';
import { AuthencationService } from '../../../services/authencation.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent implements OnInit{
  user:any;
  constructor(private auth: AuthencationService){}
  ngOnInit(): void {
    this.auth.user().subscribe((res)=>{
      this.user = res;
    }, (err) =>{
      console.log(err);
  });
};
}
