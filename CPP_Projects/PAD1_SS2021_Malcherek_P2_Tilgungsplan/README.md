# Loan Amortization Program

## Description
This C++ program calculates the amortization schedule for a loan with a fixed interest rate. It prompts the user to input the desired annuity (monthly payment) and then iteratively computes and displays the breakdown of each payment into interest, principal repayment (amortization), and remaining loan balance until the loan is fully paid off.

## Program Logic
1. The program uses predefined constants for the loan principal (`KREDITSUMME`) and the interest rate (`ZINSSATZ`).
2. It prompts the user to input the desired annuity.
3. If the annuity is less than or equal to the interest accrued on the loan principal for the first payment period, it prompts the user to enter a higher annuity.
4. It initializes variables for year counter (`jahr`), annuity, interest, principal repayment (`tilgung`), and remaining loan balance (`restschuld`).
5. It iterates through each payment period, calculating the interest, principal repayment, and updating the remaining loan balance until the balance is zero.
6. At each iteration, it prints the year, interest, principal repayment, and remaining loan balance in a tabular format.

## How to Use
1. Compile the program using a C++ compiler (e.g., g++).
2. Run the compiled executable.
3. Enter the desired annuity when prompted.
4. View the generated amortization schedule showing the breakdown of payments and remaining loan balance.

## Notes
- The program assumes a fixed interest rate and does not consider additional factors such as fees or changes in interest rates over time.
- Make sure to enter a valid annuity amount greater than the minimum required to cover the interest accrued for the first payment period.