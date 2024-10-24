describe('Login page', () => {
    beforeEach(() => {
      cy.visit('localhost:8000')
    })
    context('Login form', () => {
        it.only('username emtpy', () => {
            cy.get('#password').type('15102004')
            cy.get('button').click()
            cy.get('#username').invoke('prop', 'validationMessage').should('equal', 'Please fill out this field.')
        })
        it('login success', () => {
            cy.get('#username').type('0306221011')
            cy.get('#password').type('15102004')
            cy.get('button').click()
        })
        it('login faile', () => {
            cy.get('#username').type('a')
            cy.get('#password').type('a')
            cy.get('button').click()
            cy.get('.error__title').should('exist').contains('Tài khoản hoặc mật khẩu không chính xác.')
        })
    })
})
