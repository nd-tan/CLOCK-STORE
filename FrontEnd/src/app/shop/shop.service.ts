import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Brand, Category, Product, Register} from './shop';
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
}
