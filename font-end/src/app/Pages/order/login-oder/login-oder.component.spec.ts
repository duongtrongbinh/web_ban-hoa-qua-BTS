import { ComponentFixture, TestBed } from '@angular/core/testing';

import { LoginOderComponent } from './login-oder.component';

describe('LoginOderComponent', () => {
  let component: LoginOderComponent;
  let fixture: ComponentFixture<LoginOderComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [LoginOderComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(LoginOderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
