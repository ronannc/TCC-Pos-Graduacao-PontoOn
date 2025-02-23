import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ShowCompaniesComponent } from './show-companies.component';

describe('ShowComponent', () => {
  let component: ShowCompaniesComponent;
  let fixture: ComponentFixture<ShowCompaniesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ShowCompaniesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ShowCompaniesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
