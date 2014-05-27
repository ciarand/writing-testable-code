generate:
	rm -rf presentation/*
	remarkable remark presentation.md presentation/index

watch:
	reflex -r "\.md$$" -- make generate
