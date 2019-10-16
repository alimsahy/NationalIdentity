# National Identity
Turkish National Identity verifier and finder.

This PHP class can verify your Turkish National Identity number using algorithm without holder name and birthdate. Also, you can find your family members identity numbers using your National identity.

Please use this code for your personal purpose and education. DO NOT USE FOR BAD PURPOSES

# Identity Verification
It's same with 'Finding Family Members Identity Number' without Step 2. You can follow same way to verify identity number.

# Finding Family Members Identity Number

* Step 1: Remove last 2 digit of your national identity number
* Step 2: Add 29.999 to your national identity number.
* Step 3: To find 10th and 11th digit of identity number, follow this algorithm

Finding 10th digit.

![10th](https://raw.githubusercontent.com/alimsahy/NationalIdentity/master/algo.png)


last digit of x will give you 10th digit.



Finding 11th digit

![11th](https://raw.githubusercontent.com/alimsahy/NationalIdentity/master/algo11.png)


last digit of x will give you 11th digit.



By repeating the identity number you found from step 1, you can find the indentity numbers of the other family members.

# Brute Forcing

You can verify the identity numbers of your family members that you find on your own identity number by trying random names and birth dates. If you know the name of the family member whose identity number you want to know, you can use brute force using random birth dates for the date of birth.

You dont need to use brute force for surname for mens in your family. You may have to use brute force for married womens (i.e your sister, cousin etc.) 

