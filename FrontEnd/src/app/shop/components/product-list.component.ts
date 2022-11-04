import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { ShopService } from './../shop.service';
import { environment } from 'src/environments/environment';
import { HeaderComponent } from './header.component';
@Component({
  selector: 'app-product-list',
  templateUrl: '../templates/product-list.component.html',
})
export class ProductListComponent implements OnInit {
  constructor(
    private shopService : ShopService,
     ) { }
  brand_id: any;
  cate_id: any;
  product_id: any;
  products: any[] = [];
  brands: any[] = [];
  categories: any[] = [];
  trending_top:any[] =[];
  url: string = environment.url;
  listCart: any;
  listCartByLike: any;
  cartSubtotal: number = 0;
  cartSubByLiketotal: number = 0;
  ngOnInit(): void {
    this.product_list();
    this.band_list();
    this.cate_list();
    this.trending();
    
  }

  product_list(){
    this.shopService.product_list().subscribe(res =>{
      this.products = res;
      console.log(res.length);

    })
  }
  band_list(){
    this.shopService.brand_list().subscribe(res => {
      this.brands = res;
    })
  }
  cate_list(){
    this.shopService.cate_list().subscribe(res => {
      this.categories = res;
    })
  }
  product_OfBrand(brand_id:any){
    this.brand_id= brand_id;
    this.shopService.brand_list().subscribe(res =>{
      this.brands= res;
      for(const brand of this.brands){
        if(this.brand_id == brand.id){
          this.products = brand.products;
        }
      }
    })
  }
  product_OfCate(cate_id:any){
    this.cate_id= cate_id;
    this.shopService.cate_list().subscribe(res =>{
      this.categories= res;
      for(const category of this.categories){
        if(this.cate_id == category.id){
          this.products = category.products;
        }
      }
    })
  }
  trending(){
    this.shopService.tranding_top().subscribe(res =>{
      this.trending_top = res;
    })
  }
  addToCart(id: number) {
    this.shopService.addToCart(id).subscribe(res => {
      this.shopService.getAllCart()
      alert('Thêm vào giỏ thành công');
    })
  }
  addToCartByLike(id: number) {
    this.shopService.addToCartByLike(id).subscribe(res => {
      this.shopService.getAllCartByLike();
      alert('Thêm vào giỏ yêu thích thành công');
    })
  }
  getAllCart() {
    this.shopService.getAllCart().subscribe(res => {
      this.listCart = res;
      this.cartSubtotal = 0;
      for (let cart of this.listCart) {
        this.cartSubtotal += cart.price * cart.quantity;
      }
    });
  }
  getAllCartBylike() {
    this.shopService.getAllCartByLike().subscribe(res => {
      this.listCartByLike = res;
      this.cartSubByLiketotal = 0;
      for (let cartlike of this.listCartByLike) {
        this.cartSubByLiketotal += cartlike.price * cartlike.quantity;
      }
    });
  }
}
