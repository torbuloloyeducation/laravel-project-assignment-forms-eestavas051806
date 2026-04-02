# Activity 2: Reflection Answers

## Task 1: Understanding the Flow

The form flow works like this: when a user visits the `/formtest` page, they see a form where they can type in their email address. After they hit the submit button, the form sends a POST request to the same route, which validates the email and stores it in the session. The page then reloads and displays all the emails that have been saved so far. This way, the data persists across page refreshes because it's stored in the session, not just in memory.

---

## Reflection Questions

### 1. What is the difference between GET and POST?

GET and POST are both HTTP methods, but they work differently. GET is used when you want to retrieve or view something—like when you click a link or load a page. The data gets sent through the URL, so you can see it in the address bar. POST, on the other hand, is used when you're submitting data that changes something on the server, like adding an email to a list. The data is sent in the request body, so it's not visible in the URL. POST is also more secure for sensitive information because it doesn't expose the data in the browser history or address bar.

### 2. Why do we use `@csrf` in forms?

We use `@csrf` to protect against Cross-Site Request Forgery attacks. Basically, it's a security feature that makes sure the form submission is actually coming from your website and not from some malicious site trying to trick users into submitting data without their knowledge. Laravel generates a unique token for each session, and when the form is submitted, it checks if the token matches. If it doesn't, the request gets rejected. Without `@csrf`, someone could potentially create a fake form on another site that submits data to your application without the user realizing it.

### 3. What is session used for in this activity?

In this activity, session is used to temporarily store the list of emails that users submit through the form. Since HTTP is stateless (meaning each request doesn't remember what happened before), we need a way to keep track of data between page loads. The session stores the emails array on the server side and associates it with the user's browser session. This way, when the user adds a new email or deletes one, the changes persist even after the page refreshes. It's like a temporary storage space that lasts as long as the user is actively using the site.

### 4. What happens if session is cleared?

If the session is cleared, all the stored emails will be lost. The user would go back to seeing an empty list, as if they never added any emails in the first place. This can happen if the user manually clears their browser cookies, if the session expires after a certain period of inactivity, or if we explicitly call `session()->forget('emails')` in the code (like we do in the "Delete All" route). Basically, clearing the session resets everything back to the starting point, and there's no way to recover the data unless it was saved somewhere more permanent, like a database.

---

## Additional Notes

Working on this activity helped me understand how Laravel handles forms and sessions. At first, I wasn't sure how the data was being stored between page loads, but once I realized it was using sessions, everything clicked. The validation part was also interesting—it's cool how Laravel makes it so easy to check if an email is valid without having to write a bunch of custom code. The trickiest part was probably implementing the individual delete buttons, since I had to figure out how to pass the index of each email to the delete route. Overall, it was a good learning experience, and I feel more comfortable working with forms and sessions now.
