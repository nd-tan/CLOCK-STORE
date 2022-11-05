import { HttpClientModule, HttpHandler, HttpEvent, HTTP_INTERCEPTORS } from '@angular/common/http';

import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FooterComponent } from './shop/components/footer.component';
import { HeaderComponent } from './shop/components/header.component';
import { JWTInterceptorService } from './shop/jwtinterceptor.service';
import { ShopRoutingModule } from './shop/shop-routing.module';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ShopRoutingModule,
    HttpClientModule,
  ],
  providers: [{ provide: HTTP_INTERCEPTORS, useClass: JWTInterceptorService, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: JWTInterceptorService, multi: true },],
  bootstrap: [AppComponent]
})
export class AppModule { }
