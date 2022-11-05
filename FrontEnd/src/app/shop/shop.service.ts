import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Brand, Category, Product, Register, Images} from './shop';
import { environment } from './../../environments/environment';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ShopService {

  constructor(private http: HttpClient) { }

  product_list(): Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlAllProducts);
  }
  brand_list(): Observable<Brand[]> {
    return this.http.get<Brand[]>(environment.urlGetAllBrand);
  }
  cate_list(): Observable<Category[]> {
    return this.http.get<Category[]>(environment.urlAllCategories);
  }
  tranding_top(): Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlTrendingPro);
  }
  product_images(id:any): Observable<Images[]> {
    return this.http.get<Images[]>(environment.urlAllImage + '/'+ id);
  }
  product_detail(id:any): Observable<Product>{
    return this.http.get<Product>(environment.urlIdProduct+'/'+id)
  }
  addToCart(id: number){
    return this.http.get(environment.urlAddToCart+id);
  }
  getAllCart(){
    return this.http.get(environment.urlGetAllCart);
  }
  updateQuantity(id: any, quantity: any){
    return this.http.get(environment.urlUpdateCart+id+'/'+quantity);
  }
  deleteCart(id: any){
    return this.http.get(environment.urlDeleteCart+id);
  }
  deleteAllCart(){
    return this.http.get(environment.urlDeleteAllCart);
  }

  createOrder(){
    return this.http.get(environment.urlCreateOrder);
  }
  getAllProvince(){
    return this.http.get(environment.urlGetAllProvince);
  }
  getAllDistrictByProvinceId(id: any){
    return this.http.get(environment.urlGetAllDistrictByProvince+id);
  }
  getAllWardByDistrictById(id: any){
    return this.http.get(environment.urlGetAllWardByDistrict+id);
  }
  storeOrder(request: any){
    return this.http.post(environment.urlOrderStore, request);
  }
  showOrder(id: any){
    return this.http.get(environment.urlOrderShow+id);
  }
  
  addToCartByLike(id: number){
    return this.http.get(environment.urlAddToCartByLike+id);
  }
  deleteCartByLike(id: any){
    return this.http.get(environment.urlDeleteCartByLike+id);
  }
  getAllCartByLike(){
    return this.http.get(environment.urlGetAllCartByLike);
  }
  
}
