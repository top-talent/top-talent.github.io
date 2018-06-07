import Vue from 'vue'
import App from '../../../src/App.vue'

describe('App.vue', () => {
  it('should render correct contents', () => {
    const vm = new Vue({
      template: '<div><app></app></div>',
      components: { App }
    }).$mount()

    expect(vm.$el.querySelectorAll('#app').length).toBe(1); // app container
    expect(vm.$el.querySelector('#search')).toBeTruthy(); // search div
    expect(vm.$el.querySelector('#search > input').name).toBe('query'); // search input
    expect(vm.$el.querySelector('#barchart')).toBeTruthy(); // barchart component
    expect(vm.$el.querySelector('#grid')).toBeTruthy(); // grid component
  });
});
