import { Component, OnInit } from '@angular/core';
import { MeteoService } from "../meteo.service";

@Component({
  selector: 'app-meteo',
  templateUrl: './meteo.component.html',
  styleUrls: ['./meteo.component.css']
})
export class MeteoComponent implements OnInit {

  data: any = []

  constructor(private meteoService: MeteoService) {
    this.meteoService.getData().subscribe(data=> {

      this.data = data
      console.log(this.data)
    })



  }

  ngOnInit(): void {
  }

}
