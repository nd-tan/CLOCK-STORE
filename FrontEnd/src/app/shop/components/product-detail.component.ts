import { Component, OnInit } from '@angular/core';
import { ShopService } from './../shop.service';
import { environment } from 'src/environments/environment'; '';
import { FormControl, FormGroup, FormBuilder } from '@angular/forms';
import { Product} from '../shop';
import { map, Observable, switchMap } from 'rxjs';
import { ActivatedRoute, Router } from '@angular/router';
@Component({
  selector: 'app-product-detail',
  templateUrl: '../templates/product-detail.component.html',
})
export class ProductDetailComponent implements OnInit {

  constructor(
    private shopService: ShopService,
    private _route: ActivatedRoute
    ) { }

  url: string = environment.url;
  id: any;
  product_id: any;
  products: any;
  product: any;
  images:any;
  trending_top :any[]=[];
  main_prodcut_image = document.querySelector('img#main_product_image');
  ngOnInit(): void {
    this.id = this._route.snapshot.params['id'];

    this.shopService.product_detail(this.id).subscribe(res =>{
      this.products = res;
      for( let product of this.products){
        this.product = product;
      }
      this.trending();
    });
    this.shopService.product_images(this.id).subscribe(res => {
      this.images = res;

    })

  }
  trending(){
    this.shopService.tranding_top().subscribe(res =>{
      this.trending_top = res;
    })
  }
}
