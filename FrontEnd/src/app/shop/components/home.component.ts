import { Component, OnInit } from '@angular/core';
import { ShopService } from './../shop.service';
import { environment } from 'src/environments/environment'; '';
@Component({
  selector: 'app-home',
  templateUrl: './../templates/home.component.html',
})
export class HomeComponent implements OnInit {

  constructor( private shopService : ShopService) { }
  url: string = environment.url;
  trending_top:any[] =[];

  ngOnInit(): void {
    this.trending();
  }

  trending(){
    this.shopService.tranding_top().subscribe(res =>{
      this.trending_top = res;
    })
  }

}
