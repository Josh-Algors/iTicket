
//First Test

// Initialize variables
var month = 0; // January
var year = 2022;

// Loop through every month between January 2022 and December 2026
while (year <= 2026 && month <= 11) 
{
  // Check if the current month has 31 days
    let first = new Date(year, month + 1, 0).getDate();

    let first_date = new Date(year, month, 30);
    let second_date = new Date(year, month, 31);
    let third_date = new Date(year, month, 32);

    console.log(first);

    if(first === 31)
    {
        lastDays.push(first_date);
        lastDays.push(second_date);
        lastDays.push(third_date);
    }
    else if(first === 30)
    {
        lastDays.push(first_date);
        lastDays.push(second_date);
    }
    else if(first === 29)
    {
        lastDays.push(first_date);
    }

  // Increment the month counter and adjust the year if necessary
  month++;

  if (month > 11)
  {
    month = 0; // January
    year++;
  }

}

console.log(lastDays);
      

//========================================================================================================

//second Test

function getDatesOnDaysOfWeek(...daysOfWeek)
{
    const result = [];
    const startDate = new Date('2023-04-01');
    const endDate = new Date('2023-05-31');
  
    while (startDate <= endDate) {
      if (daysOfWeek.includes(startDate.getDay())) {
        result.push(new Date(startDate));
      }
      startDate.setDate(startDate.getDate() + 1);
    }
  
    return result;
  }
  
  // 0 - Sunday, 1 - Monday, 2 - Tuesday, 3 - Wednesday, 4 - Thursday, 5 - Friday, 6 - Saturday
  const selectedDays = getDatesOnDaysOfWeek(1, 3, 4, 6);
  console.log(selectedDays);

  const lastDays = [];
