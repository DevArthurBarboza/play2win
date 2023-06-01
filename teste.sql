SELECT name, title FROM courses
LEFT JOIN teaches
    ON teaches.course_id = courses.course_id
LEFT JOIN instructors
    ON instructors.instructor_id = teaches.instructor_id
    AND instructor.department = 'Music'
