import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { ShopService } from './../shop.service';
import { environment } from 'src/environments/environment';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
@Component({
  selector: 'app-product-list',
  templateUrl: '../templates/product-list.component.html',
})
export class ProductListComponent implements OnInit {
  constructor(private shopService : ShopService,
   private _route: ActivatedRoute,
   private fb: FormBuilder,
   private toastr: ToastrService

     ) { }

  data: any;
  id: any;
  search: any;
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
  serachForm!: FormGroup;
  page: number = 1;
  count:number =0;
  tableSize: number=8;
  tableSizes:any = [5,10,15,20];
  color_1:any = 'dark';
  color_2:any = 'dark';
  color_3:any = 'dark';


  ngOnInit(): void {
    this.product_list();
    this.band_list();
    this.cate_list();
    this.serachForm = this.fb.group({
      search: [''],
    })
    if(this._route.snapshot.params['id'] && this._route.snapshot.params['search'] ){
      this.id = this._route.snapshot.params['id'];
      this.search = this._route.snapshot.params['search'];
      console.log(this.id);
      console.log(this.search);
      if(this.search=="cate")
      {
        this.product_OfCate(this.id)
      }else if( this.search == "brand"){
        this.product_OfBrand(this.id)
      }else {
        this.trending();
      }
    }

  }
  reset_color(){
    this.color_1 = 'dark';
    this.color_2 = 'dark';
    this.color_3 = 'dark';
  }
  product_list(){
    this.reset_color();
    this.shopService.product_list().subscribe(res =>{
      this.products = res;
      this.color_1='warning';
    })
  }
  ontableDataChange(event: any){
    this.page = event;
    this.product_list;
  }
  onTableSizeChange(event:any):void{
    this.tableSize = event.target.value;
    this.page = 1;
    this.product_list();
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
      this.toastr.success('Thành công', 'Thêm vào giỏ hàng!');
    })
  }
  addToCartByLike(id: number) {
    this.shopService.addToCartByLike(id).subscribe(res => {
      this.toastr.success('Thành công', 'Thêm vào giỏ hàng yêu thích!');

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
  product_male(gender:any){
    this.reset_color();
    if(gender == 'Nam'){
      this.color_2 = 'warning';
    }else{
      this.color_3 = 'warning';
    }
    this.shopService.product_list().subscribe(res =>{
    this.products = res;
    let array: any[] = [];
      for(let product of this.products){
        if(product.type_gender == gender)
        {
          array.push(product);
        }
      }
      this.products=array;
    });
  }

  product_by_price(price:any){
    this.shopService.product_list().subscribe(res =>{
    this.products = res;
    let array: any[] = [];
      switch(price){
        case '2t' :
          for(let product of this.products){
            if(product.price < 2000000)
            {
              array.push(product);
            }
          }
          this.products=array;
          break;
        case '2t-5t':
          for(let product of this.products){
            if(product.price >= 2000000 && product.price <= 5000000)
            {
              array.push(product);
            }
          }
          this.products=array;
          break;
        case '5t-10t':
          for(let product of this.products){
            if(product.price >= 5000000 && product.price <= 10000000)
            {
              array.push(product);
            }
          }
          this.products=array;
          break;
        case '10t-20t':
          for(let product of this.products){
            if(product.price >= 10000000 && product.price <= 20000000)
            {
              array.push(product);
            }
          }
          this.products=array;
          break;
        case '20t-50t':
          for(let product of this.products){
            if(product.price >= 20000000 && product.price <= 50000000)
            {
              array.push(product);
            }
          }
          this.products=array;
          break;
        case '50t':
          for(let product of this.products){
            if(product.price > 50000000)
            {
              array.push(product);
            }
          }
          this.products=array;
          break;
      }

    });
  }
  product_search(search : any){
    let keywork = this.serachForm.value.search;
    this.shopService.product_search(keywork).then(res => {
    this.data = res;
    this.products = this.data
    })
  }

}
