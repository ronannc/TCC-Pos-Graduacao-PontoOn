import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateCompaniesComponent } from './create-companies.component';

describe('CreateComponent', () => {
  let component: CreateCompaniesComponent;
  let fixture: ComponentFixture<CreateCompaniesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CreateCompaniesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CreateCompaniesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
