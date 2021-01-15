import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SelectSyndicateComponent } from './select-syndicate.component';

describe('SelectSyndicateComponent', () => {
  let component: SelectSyndicateComponent;
  let fixture: ComponentFixture<SelectSyndicateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SelectSyndicateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SelectSyndicateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
