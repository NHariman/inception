#include <stdio.h>

int		is_true(void)
{
	return (1);
}

int		is_false(void)
{
	return (0);
}

int		main(void)
{
	printf("function is_true, returns a 1\n");
	printf("if (is_true()), the result: yay, will be printed.\n");
	if (is_true())
		printf("yay\n");
	printf("if (!is_true()), the result: yay, will NOT be printed.\n");
	printf("this is because is_true returns a 1, and the if wants a 0\n");
	if (!is_true())
		printf("yay\n");
	printf("\nfunction is_false, returns a 0\n");
	printf("if (is_false()), the result: returns a 0, will NOT be printed.\n");
	if (is_false())
		printf("yay\n");
	printf("\nif (!is_false()), the result: yay, will be printed.\n");
	printf("this is because is_false returns a 0, and the if wants a 1\n");
	if (!is_false())
		printf("yay\n");
	return (0);
}
