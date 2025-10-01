import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-principal',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './principal.component.html',
  styleUrls: ['./principal.component.css']
})
export class PrincipalComponent implements OnInit {
  menuOpen = false;
  projects = [
    { image: 'assets/images/project1.jpg', title: 'HexaSys' },
    { image: 'assets/images/project2.jpg', title: 'Smart School' },
    { image: 'assets/images/project3.jpg', title: 'Check Motors' },
    { image: 'assets/images/project4.jpg', title: 'MyGyM' },
    { image: 'assets/images/project5.jpg', title: 'SchoolLate' },
    { image: 'assets/images/project6.jpg', title: 'MyPet' },
  ];

  currentSlide = 0;

  ngOnInit() {
    this.initializeMap();
  }

  private initializeMap() {
    // Aqui você pode adicionar a inicialização do mapa
    // usando Google Maps ou outra biblioteca de sua preferência
  }

  nextSlide() {
    this.currentSlide = (this.currentSlide + 1) % this.projects.length;
  }

  previousSlide() {
    this.currentSlide = (this.currentSlide - 1 + this.projects.length) % this.projects.length;
  }

  goToSlide(index: number) {
    this.currentSlide = index;
  }
}
