import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IndexCompaniesComponent } from './index-companies.component';

describe('IndexComponent', () => {
  let component: IndexCompaniesComponent;
  let fixture: ComponentFixture<IndexCompaniesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IndexCompaniesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IndexCompaniesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
