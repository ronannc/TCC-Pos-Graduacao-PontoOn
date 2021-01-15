import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MotherNameComponent } from './mother-name.component';

describe('MotherNameComponent', () => {
  let component: MotherNameComponent;
  let fixture: ComponentFixture<MotherNameComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MotherNameComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MotherNameComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
