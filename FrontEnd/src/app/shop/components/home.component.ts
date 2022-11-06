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
  addToCart(id: number) {
    this.shopService.addToCart(id).subscribe(res => {
      this.shopService.getAllCart();
      alert('Thêm vào giỏ thành công');
    })
  }
  addToCartByLike(id: number) {
    this.shopService.addToCartByLike(id).subscribe(res => {
      this.shopService.getAllCartByLike();
      alert('Thêm vào giỏ yêu thích thành công');
    })
  }
}
