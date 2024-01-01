# AIESEC_EB_Voting_System
# AIESEC Entity Board Voting System

## Overview
The EB AIESEC Voting System is designed to facilitate the selection process for leadership roles within the AIESEC local entity. This platform ensures a fair and balanced representation of various stakeholders in the decision-making process.

## Voter Categories and Weightage
The system considers the following categories of voters, each with a specific weightage:

- **Ex-Entity Board (Ex EB) Members:** 30% of the total vote
- **Old Members (6 months or more of membership):** 40%
- **Sub-Department Team Leaders:** 15%
- **New Members (Less than 6 months of membership):** 15%

## Voting Criteria
To successfully pass the voting process and gain the trust of the Local Entity, an applicant must achieve a minimum of 50% of the total votes and at least one vote.

This system aims to foster inclusivity and democratic decision-making, ensuring that the leadership selection process reflects the diverse perspectives within the AIESEC community.

# Future Development Features

## 1. Individual Department Results and Round Display

Enhance the system to enable applicants from each department to view their results individually. Additionally, introduce a feature to display results for all applicants in each voting round, promoting transparency and providing insights into the decision-making process.

## 2. Ensure Total Entries Match Voter Numbers

Implement a validation mechanism to ensure that the total number of entries matches the total number of voters, including neutrals. Enhance the system to automatically set non-filled integer inputs to zero, ensuring accurate representation and alignment with the total voter count.

## 3. Applicant Deletion Option

Introduce a user-friendly deletion option for applicants, allowing administrators to manage the applicant pool effectively. Consider implementing a deletion option for each member category's total numbers to maintain data accuracy.

## 4. Optimize `members_number` Database Table

Revise the structure of the `members_number` database table to store the total numbers of each member category only once. This optimization ensures data integrity and simplifies the database structure.I need to implement a logical solution for handling unique storage of these values.

**Note:** These proposed features aim to enhance the functionality and user experience of the voting system, contributing to a more robust and efficient application.
