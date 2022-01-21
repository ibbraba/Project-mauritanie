import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";


@Injectable({
  providedIn: 'root'
})
export class MeteoService {

  constructor(private http: HttpClient) { }

  getData(){
    let url = "https://api.openweathermap.org/data/2.5/weather?q=nouakchott&appid=3d778e434db05b9e254f386bfa812eb9&units=metric&lang=fr"
    return this.http.get(url)
  }
}
